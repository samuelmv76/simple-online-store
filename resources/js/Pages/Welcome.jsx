import { Head } from "@inertiajs/inertia-react";

import { Pagination } from "../components/Pagination";
import { Products } from "../components/Products";
import { Header } from "../components/Header";
import { useFilters } from "../hook/useFilters";

import { useEffect, useContext } from 'react'
import { ProductContext } from "../context/products";

export default function Welcome({ productsPage, categories, products }) {
    const { filtersProducts, setCategories, filters } = useFilters()
    const filteredProducts = filtersProducts(products)

    const { setProducts } = useContext(ProductContext)

    useEffect(() => {
        setCategories(categories)
        setProducts(products)
    }, [])
        // 👇 DEBUG
        console.log("Categoría seleccionada:", filters.category)
        products.forEach(p =>
            console.log("Producto:", p.name, "| Categoría:", p?.category?.name)
        )

    return (
        <>
            <Header />

            <div className="mb-3">
                {
                    (filters.minPrice === 0 && filters.category === 'all') && (
                        <>
                            <Products products={productsPage.data} />
                            <div className="d-flex justify-content-center">
                                <Pagination links={productsPage.links} />
                            </div>
                        </>
                    )
                }

                {
                    (filters.minPrice !== 0 || filters.category !== 'all') && (
                        filteredProducts.length > 0
                            ? <Products products={filteredProducts} />
                            : <p className="text-center mt-4">No hay productos que coincidan con los filtros</p>
                    )
                }
            </div>
        </>
    );
}
