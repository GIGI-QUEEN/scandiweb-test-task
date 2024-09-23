import { Book, DVD, Furniture, Product } from "../../types/product";
import "./ProductCard.scss";

interface IProductCardProps {
  product: Product;
  isSelected: boolean;
  handleItemToggle: (id: number) => void;
}

const ProductCard = ({
  product,
  isSelected,
  handleItemToggle,
}: IProductCardProps) => {
  return (
    <div className="card-container">
      <input
        type="checkbox"
        className="delete-checkbox"
        checked={isSelected}
        onChange={() => handleItemToggle(product.id)}
      />
      <p>{product.sku}</p>
      <p>{product.name}</p>
      <p>{product.price.toFixed(2)}$</p>
      {isDVD(product) && <p>Size: {product.size}MB</p>}
      {isBook(product) && <p>Weight: {product.weight}kg</p>}
      {isFurniture(product) && (
        <p>
          Dimension: {`${product.height}x${product.width}x${product.length}`}
        </p>
      )}
    </div>
  );
};

const isDVD = (product: Product): product is DVD => {
  return "size" in product;
};

const isBook = (product: Product): product is Book => {
  return "weight" in product;
};

const isFurniture = (product: Product): product is Furniture => {
  return "height" in product;
};

export default ProductCard;
