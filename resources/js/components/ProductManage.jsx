import { useCart } from "../hook/useCart";
import toast, { Toaster } from 'react-hot-toast';
import { CiShoppingBasket, CiTrash } from "react-icons/ci";

export function ProductManage({ product }) {
    const { hasProduct, addProductCart, removeProductCart } = useCart();

    const isProductInCart = hasProduct(product);
    const buttonType = isProductInCart ? 'danger' : 'secondary';

    const handleClick = () => {
        if (!product) return;

        if (isProductInCart) {
            removeProductCart(product);
        } else {
            addProductCart(product);
            toast.success('Producto agregado al carro');
        }
    };

    return (
        <>
            <button
                className={`btn btn-${buttonType}`}
                onClick={handleClick}
            >
                {
                    isProductInCart
                        ? <CiTrash className="fs-3" />
                        : <CiShoppingBasket className="fs-3" />
                }
            </button>

            <Toaster position="bottom-right" reverseOrder={false} />
        </>
    );
}
