import { useFilters } from "../hook/useFilters";

export function Header() {
    const { filters, setFilters, categories } = useFilters();

    const handleMinChange = (e) => {
        const value = parseFloat(e.target.value) || 0;
        setFilters(prev => ({ ...prev, minPrice: value }));
    };

    const handleMaxChange = (e) => {
        const value = parseFloat(e.target.value) || Infinity;
        setFilters(prev => ({ ...prev, maxPrice: value }));
    };

    const handleCategoryChange = (e) => {
        setFilters(prev => ({ ...prev, category: e.target.value }));
    };

    return (
        <div className="d-flex flex-wrap gap-3 align-items-center p-3">
            <div>
                <label htmlFor="minPrice">Precio mínimo</label>
                <input
                    id="minPrice"
                    type="number"
                    className="form-control"
                    value={filters.minPrice}
                    onChange={handleMinChange}
                    placeholder="Mín"
                    min="0"
                />
            </div>
            <div>
                <label htmlFor="maxPrice">Precio máximo</label>
                <input
                    id="maxPrice"
                    type="number"
                    className="form-control"
                    value={filters.maxPrice === Infinity ? '' : filters.maxPrice}
                    onChange={handleMaxChange}
                    placeholder="Máx"
                    min="0"
                />
            </div>
            <div>
                <label htmlFor="category">Categoría</label>
                <select
                    id="category"
                    className="form-select"
                    value={filters.category}
                    onChange={handleCategoryChange}
                >
                    <option value="all">Todos</option>
                    {categories.map((cat) => (
                        <option key={cat.id_category} value={cat.name.toLowerCase().trim()}>
                            {cat.name}
                        </option>
                    ))}
                </select>
            </div>
        </div>
    );
}
