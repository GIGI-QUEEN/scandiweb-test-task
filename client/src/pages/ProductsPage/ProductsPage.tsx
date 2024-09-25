import Header from "../../components/Header/Header";
import ProductCard from "../../components/ProductCard/ProductCard";
import { useProducts } from "../../hooks/useProducts";
import { addProductRoute } from "../../routes/RouteNames";
import "./ProductsPage.scss";

const ProductsPage = () => {
  const {
    products,
    navigate,
    handleItemToggle,
    handleMassDelete,
    selectedItems,
  } = useProducts();
  return (
    <div>
      <Header pageTitle="Product List">
        <button onClick={() => navigate(addProductRoute)}>add</button>
        <button
          id="delete-product-btn"
          onClick={() => handleMassDelete()}
          //disabled={selectedItems.length === 0}
        >
          mass delete
        </button>
      </Header>
      <div className="main-container products-container">
        {products?.map((product, index) => (
          <ProductCard
            product={product}
            key={index}
            isSelected={selectedItems.includes(product.id)}
            handleItemToggle={handleItemToggle}
          />
        ))}
      </div>
    </div>
  );
};

export default ProductsPage;
