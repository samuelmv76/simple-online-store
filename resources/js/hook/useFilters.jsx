import { useContext } from 'react';
import { FiltersContext } from '../context/filters';

export function useFilters() {
    const { filters, setFilters, categories, setCategories } = useContext(FiltersContext)

    const filtersProducts = (products) => {
        return products.filter(product =>
            product.price >= filters.minPrice &&
            product.price <= filters.maxPrice &&
            (
                filters.category === 'all' ||
                product.category?.name?.toLowerCase().trim() === filters.category.toLowerCase().trim()
            )
        );
    }    

    return { filtersProducts, filters, setFilters, categories, setCategories }
}
