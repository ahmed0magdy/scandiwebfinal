import React, { useState, useEffect } from "react";
import { Form, Container } from "react-bootstrap";
import Navbar from "./Navbar";
import useCategory from "../hooks/useCategory";
import useCreateProduct from "../hooks/useCreateProduct";
import { useNavigate } from "react-router-dom";
import { ProductInput } from "../services/types";
import CategoryAttributes from "./CategoryAttributes";
import CategorySelector from "./CategorySelector";
import NotificationAlert from "./NotificationAlert";
import ProductForm from "./ProductForm";
import validateProduct from "../helpers/validationService";

const AddProduct = () => {
  const { data: { categories } = { categories: [] } } = useCategory();
  const [createProduct] = useCreateProduct();
  const [selectedCategory, setSelectedCategory] = useState<string>("");
  const [selectedProduct, setSelectedProduct] = useState<ProductInput>({
    sku: "",
    name: "",
    price: null,
    attributes: [],
  });
  const [notification, setNotification] = useState<string | null>(null);

  const navigate = useNavigate();
  const navigateToProductList = () => {
    navigate("/");
  };

  useEffect(() => {
    if (selectedCategory) {
      const category = categories.find((cat) => cat.id === selectedCategory);

      if (category) {
        setSelectedProduct((prevProduct) => ({
          ...prevProduct,
          attributes: category.attributes.map((attr) => ({
            id: attr.id,
            value: "",
          })),
        }));
      }
    }
  }, [selectedCategory]);

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { id, value } = e.target;
    setSelectedProduct((prevData) => ({
      ...prevData,
      [id]: id === "price" ? (value === "" ? null : parseFloat(value)) : value,
    }));
  };

  const handleAttributeChange = (id: string, value: string) => {
    setSelectedProduct((prevData) => ({
      ...prevData,
      attributes: prevData.attributes.map((attr) =>
        attr.id === id ? { ...attr, value } : attr
      ),
    }));
  };

  const validateInput = () => {
    const errors = validateProduct(selectedProduct, selectedCategory);

    if (errors.length > 0) {
      setNotification(errors[0]);
      return false;
    }

    return true;
  };

  const handleSubmit = () => {
    if (!validateInput()) return;
    navigateToProductList();
    createProduct({
      variables: {
        product: selectedProduct,
      },
    }).catch(() => {
      console.error("Error creating product");
    });
  };

  return (
    <>
      <Navbar
        title="Add Product"
        leftButton={{
          text: "Save",
          variant: "dark",
          onClick: handleSubmit,
          className: "me-2",
        }}
        rightButton={{
          text: "Cancel",
          variant: "warning",
          onClick: navigateToProductList,
        }}
      />
      <Container>
        <NotificationAlert
          message={notification}
          onClose={() => setNotification(null)}
        />
        <Form id="product_form" onSubmit={(e) => e.preventDefault()}>
          <ProductForm
            product={selectedProduct}
            onInputChange={handleInputChange}
          />
          <CategorySelector
            categories={categories}
            onCategoryChange={(category) => setSelectedCategory(category)}
          />
          {selectedCategory && (
            <CategoryAttributes
              category={categories.find((cat) => cat.id === selectedCategory)}
              selectedProductAttributes={selectedProduct.attributes}
              onAttributeChange={handleAttributeChange}
            />
          )}
        </Form>
      </Container>
    </>
  );
};

export default AddProduct;
