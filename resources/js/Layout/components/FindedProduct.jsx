import { Link } from "@inertiajs/react";

export function FindedProduct({ product, setShowResult }) {
    const imageUrl = product?.images?.[0]?.url_imagen || '/storage/images/default-product.png';

    return (
        <div className="d-flex gap-2 border-bottom mb-1 pb-1">
            <img
                className="rounded"
                src={imageUrl}
                height={50}
                width={50}
                alt={product.name}
            />
            <div className="d-flex flex-column">
                <Link
                    className="text-capitalize"
                    href={`/products/${product.id}`} // CORREGIDO
                    onClick={() => setShowResult(false)}
                >
                    {product.name}
                </Link>
                <p className="mb-0">{product.description.slice(0, 39)}...</p>
            </div>
        </div>
    );
}
