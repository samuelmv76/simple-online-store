import { Product } from "./Product";

export function Products({ products }) {
    return (
        <div className="row">
            {products.map((product, index) => (
                <Product
                    product={product}
                    key={product.id_product || product.id || `product-${index}`}
                />
            ))}
        </div>
    );
}
