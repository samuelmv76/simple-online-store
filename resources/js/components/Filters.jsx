import { useState, useId } from 'react';
import { useFilters } from '../hook/useFilters';

export function Filters() {
    const { setFilters, filters, categories } = useFilters();

    const minId = useId();
    const maxId = useId();
    const categoryId = useId();

    const handlerMin = (e) => {
        setFilters(prev => ({
            ...prev,
            minPrice: Number(e.target.value)
        }));
    };

    const handlerMax = (e) => {
        setFilters(prev => ({
            ...prev,
            maxPrice: Number(e.target.value)
        }));
    };

    const handlerCategory = (e) => {
        setFilters(prev => ({
            ...prev,
            category: e.target.value
        }));
    };

    return (
        <div className="d-flex flex-column flex-md-row justify-content-between mt-4 gap-3">
            <div className='d-flex align-items-center gap-2'>
                <label htmlFor={minId}>Precio mínimo</label>
                <input
                    id={minId}
                    type="number"
                    className="form-control"
                    value={filters.minPrice}
                    onChange={handlerMin}
                />
            </div>

            <div className='d-flex align-items-center gap-2'>
                <label htmlFor={maxId}>Precio máximo</label>
                <input
                    id={maxId}
                    type="number"
                    className="form-control"
                    value={filters.maxPrice === Infinity ? '' : filters.maxPrice}
                    onChange={handlerMax}
                />
            </div>

            <div className='d-flex align-items-center gap-2'>
                <label htmlFor={categoryId}>Categoría</label>
                <select
                    className="form-select"
                    id={categoryId}
                    value={filters.category}
                    onChange={handlerCategory}
                >
                    <option value="all">Todos</option>
                    {categories.map((category) => (
                        <option key={category.id} value={category.name}>
                            {category.name}
                        </option>
                    ))}
                </select>
            </div>
        </div>
    );
}
