import { useNavigate } from "react-router-dom";
import Header from "../../components/Header/Header";
import { homeRoute } from "../../routes/RouteNames";
import {
  FormInput,
  FormSelectInput,
} from "../../components/FormInput/FormInput";
import "./AddProductPage.scss";
import { useAddProduct } from "../../hooks/useAddProduct";

const AddProductPage = () => {
  const navigate = useNavigate();
  const { option, handleOptionChange } = useAddProduct();
  return (
    <div>
      <Header pageTitle="Product Add">
        <button onClick={() => navigate(homeRoute)}>Save</button>
        <button onClick={() => navigate(homeRoute)}>Cancel</button>
      </Header>
      <div>
        <form
          action=""
          id="prodcut_form"
          className="main-container add-product-form"
        >
          <div className="input-box">
            <FormInput label="SKU" type="text" id="sku" />
            <FormInput label="Name" type="text" id="name" />
            <FormInput label="Price ($)" type="number" id="price" />
            <FormSelectInput
              label="Type"
              id="productType"
              options={["DVD", "Book", "Furniture"]}
              handleOptionChange={handleOptionChange}
            />
            {option === "DVD" && (
              <FormInput label="Size (MB)" type="number" id="size" />
            )}
            {option === "Book" && (
              <FormInput label="Weigth (KG)" type="number" id="weight" />
            )}
            {option === "Furniture" && (
              <>
                <FormInput label="Height (CM)" type="number" id="height" />
                <FormInput label="Width (CM)" type="number" id="width" />
                <FormInput label="Length (CM)" type="number" id="length" />
              </>
            )}
          </div>
          {option === "DVD" && <p>*Please, provide size</p>}
          {option === "Book" && <p>*Please, provide weight</p>}
          {option === "Furniture" && <p>*Please, provide dimensions</p>}
        </form>
      </div>
    </div>
  );
};

export default AddProductPage;
