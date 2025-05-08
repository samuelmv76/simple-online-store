import { Link } from "@inertiajs/react";
import { useCart } from "../hook/useCart";
import { ProductManage } from "./ProductManage";

import { CiViewTimeline } from "react-icons/ci";

import './Product.css';

export function Product({ product }) {
    const { hasProduct } = useCart();

    const imageUrl =
    product.images?.[0]?.url_imagen ||
    product.image_url ||
    'https://via.placeholder.com/300x160';


    return (
        <div className="product mt-4">
            <div className="card border-0 shadow">
                <img
                    className="border rounded bg-secondary"
                    style={{ height: "160px", objectFit: "cover", width: "100%" }}
                    src={imageUrl}
                    alt={product.name}
                />

                <div className="mt-1 container">
                    <span className="fs-5 fw-semibold">{product.name}</span>
                    <p className="mb-0 text-truncate">{product.description}</p>
                    <span className="fs-4 fw-bold">${product.price}</span>
                    <p className="mb-1 fw-semibold">
                        <span className="fw-normal">
                            {product.category?.name || "Sin categoría"}
                        </span>
                    </p>
                </div>

                <div className="mt-1 d-flex justify-content-center gap-1 pb-2">
                    <Link
                        className="btn btn-primary"
                        href={`/products/${product.id}`}
                    >
                        <CiViewTimeline className="fs-4" />
                    </Link>

                    <ProductManage product={product} />
                </div>
            </div>
        </div>
    );
}
