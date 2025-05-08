import { useState } from "react";
import { useForm } from "@inertiajs/react";

export default function ManagePeripherals({ peripherals = [] }) {
    const [editing, setEditing] = useState(null);
    const [stockValues, setStockValues] = useState(
        peripherals.reduce((acc, p) => {
            acc[p.id] = p.stock;
            return acc;
        }, {})
    );

    const { post } = useForm();

    const handleEdit = (id) => {
        setEditing(id);
    };

    const handleCancel = () => {
        setEditing(null);
    };

    const handleChange = (e, id) => {
        setStockValues(prev => ({
            ...prev,
            [id]: e.target.value
        }));
    };

    const handleSave = (id) => {
        const stock = parseInt(stockValues[id]);

        if (isNaN(stock) || stock < 0) {
            alert("El stock debe ser un número válido mayor o igual a 0");
            return;
        }

        post(`/admin/peripherals/${id}`, {
            _method: 'put',
            stock,
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => setEditing(null),
            onError: () => alert("Error al actualizar el stock")
        });
    };

    return (
        <div className="container mt-4">
            <h2 className="mb-4">Gestión de Stock</h2>

            <table className="table table-bordered table-hover">
                <thead className="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {peripherals.map(peripheral => (
                        <tr key={peripheral.id}>
                            <td>{peripheral.id}</td>
                            <td>{peripheral.name}</td>
                            <td>{peripheral.category?.name || 'Sin categoría'}</td>
                            <td>
                                {editing === peripheral.id ? (
                                    <input
                                        type="number"
                                        className="form-control"
                                        value={stockValues[peripheral.id]}
                                        onChange={(e) => handleChange(e, peripheral.id)}
                                    />
                                ) : (
                                    peripheral.stock
                                )}
                            </td>
                            <td>
                                {editing === peripheral.id ? (
                                    <>
                                        <button
                                            className="btn btn-success btn-sm me-1"
                                            onClick={() => handleSave(peripheral.id)}
                                        >
                                            Guardar
                                        </button>
                                        <button
                                            className="btn btn-secondary btn-sm"
                                            onClick={handleCancel}
                                        >
                                            Cancelar
                                        </button>
                                    </>
                                ) : (
                                    <button
                                        className="btn btn-primary btn-sm"
                                        onClick={() => handleEdit(peripheral.id)}
                                    >
                                        Editar
                                    </button>
                                )}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
