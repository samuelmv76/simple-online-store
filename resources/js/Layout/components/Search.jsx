import { useContext, useState } from 'react'
import { ProductContext } from "../../context/products";
import { FindedProduct } from './FindedProduct';
import { CiSearch } from 'react-icons/ci'
import './Search.css'

export function Search() {
    const { products } = useContext(ProductContext)
    const [productsFinded, setProductsFinded] = useState([])
    const [showResult, setShowResult] = useState(false)

    const searchProduct = (event) => {
        const keywordsFindProducts = event.target.value.toLowerCase()
        setShowResult(true)

        if (keywordsFindProducts === '') {
            return setProductsFinded([])
        }

        const findProducts = (target, keyword) => target.toLowerCase().includes(keyword)

        const results = products.filter(product =>
            findProducts(product.name, keywordsFindProducts) ||
            findProducts(product.description, keywordsFindProducts) ||
            findProducts(product.category.name, keywordsFindProducts)
        )

        setProductsFinded(results)
    }

    return (
        <form className="d-flex flex-fill justify-content-md-center gap-0" role="search">
            <span className='my-auto fs-4 border border-end-0 ps-2 pb-2 pe-2 rounded rounded-end-0 bg-primary-subtle'>
                <CiSearch />
            </span>

            <input
                className="form-control me-2 w-50 border border-start-0 rounded-start-0"
                type="search"
                placeholder="Buscar"
                aria-label="Buscar"
                onChange={searchProduct}
                onFocus={searchProduct}
            />

            {showResult && productsFinded.length > 0 && (
                <div className="position-absolute top-100 bg-white p-2 rounded overflow-auto shadow search">
                    {productsFinded.map((product, index) => (
                        <FindedProduct
                            key={product?.id_product ?? index}
                            product={product}
                            setShowResult={setShowResult}
                        />
                    ))}
                </div>
            )}
        </form>
    );
}
