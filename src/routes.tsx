import { createBrowserRouter } from "react-router-dom";
import Layout from "./pages/Layout";
import ErrorPage from "./pages/ErrorPage";
import ProductList from "./pages/ProductListPage";
import AddProduct from "./pages/AddProductPage";

const router = createBrowserRouter(
  [
    {
      path: "/",
      element: <Layout />,
      errorElement: <ErrorPage />,
      children: [
        { index: true, element: <ProductList /> },
        { path: "/add-product", element: <AddProduct /> },
      ],
    },
  ]
);

export default router;
