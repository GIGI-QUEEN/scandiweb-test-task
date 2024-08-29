import { useNavigate } from "react-router-dom";
import Header from "../../components/Header/Header";
import { homeRoute } from "../../routes/RouteNames";
import {
  FormInput,
  FormSelectInput,
} from "../../components/FormInput/FormInput";
import "./AddProductPage.scss";
import { useAddProduct } from "../../hooks/useAddProduct";
import { useFormContext } from "react-hook-form";
import { ProductAddValidationSchema } from "../../validation/productAddValidationSchema";

const AddProductPage = () => {
  const navigate = useNavigate();
  const { option, handleOptionChange, onSubmit } = useAddProduct();
  const { handleSubmit } = useFormContext<ProductAddValidationSchema>();

  return (
    <div>
      <Header pageTitle="Product Add">
        <button onClick={handleSubmit(onSubmit)} type="submit">
          Save
        </button>
        <button onClick={() => navigate(homeRoute)}>Cancel</button>
      </Header>
      <div>
        <form
          action=""
          id="prodcut_form"
          className="main-container add-product-form"
        >
          <div className="input-box">
            <FormInput label="SKU" type="text" id="sku" name="sku" />
            <FormInput label="Name" type="text" id="name" name="name" />
            <FormInput
              label="Price ($)"
              type="number"
              id="price"
              name="price"
            />
            <FormSelectInput
              name="type"
              label="Type"
              id="productType"
              options={["DVD", "Book", "Furniture"]}
              handleOptionChange={handleOptionChange}
            />
            {option === "DVD" && (
              <FormInput
                label="Size (MB)"
                type="number"
                id="size"
                name="size"
              />
            )}
            {option === "Book" && (
              <FormInput
                label="Weigth (KG)"
                type="number"
                id="weight"
                name="weight"
              />
            )}
            {option === "Furniture" && (
              <>
                <FormInput
                  label="Height (CM)"
                  type="number"
                  id="height"
                  name="height"
                />
                <FormInput
                  label="Width (CM)"
                  type="number"
                  id="width"
                  name="width"
                />
                <FormInput
                  label="Length (CM)"
                  type="number"
                  id="length"
                  name="length"
                />
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
