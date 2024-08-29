import { createBrowserRouter } from "react-router-dom";
import App from "../App";
import { homeRoute, addProductRoute } from "./RouteNames";
import ProductsPage from "../pages/ProductsPage/ProductsPage";
import AddProductPage from "../pages/AddProduct/AddProduct";

const router = createBrowserRouter([
  {
    path: homeRoute,
    element: <App />,
    children: [{ path: homeRoute, element: <ProductsPage /> }],
  },
  { path: addProductRoute, element: <AddProductPage /> },
]);

export default router;
