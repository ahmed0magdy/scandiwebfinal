import { useState } from "react";
import { Container } from "react-bootstrap";
import { useNavigate } from "react-router-dom";
import useDeleteProducts from "../hooks/useDeleteProducts";
import useProducts from "../hooks/useProducts";
import Navbar from "./Navbar";
import ProductListContainer from "./ProductListContainer";
import { getFormattedAttributes } from "../helpers/Formatter";

const ProductList = () => {
  const { data } = useProducts();
  const [selectedProducts, setSelectedProducts] = useState<string[]>([]);
  const [deleteProducts] = useDeleteProducts();
  const navigate = useNavigate();

  const handleCheckboxChange = (id: string) => {
    setSelectedProducts((prevSelected) =>
      prevSelected.includes(id)
        ? prevSelected.filter((productId) => productId !== id)
        : [...prevSelected, id]
    );
  };

  const handleMassDelete = () => {
    if (selectedProducts.length > 0) {
      deleteProducts({
        variables: { id: selectedProducts },
      });
      setSelectedProducts([]);
    }
  };

  return (
    <>
      <Navbar
        title="Product List"
        leftButton={{
          text: "ADD",
          variant: "primary",
          onClick: () => navigate("/add-product"),
          className: "me-3",
        }}
        rightButton={{
          text: "MASS DELETE",
          variant: "danger",
          onClick: handleMassDelete,
          disable: !selectedProducts.length,
        }}
      />
      <Container>
        <ProductListContainer
          products={data?.products || []}
          selectedProducts={selectedProducts}
          onCheckboxChange={handleCheckboxChange}
          getFormattedAttributes={getFormattedAttributes}
        />
      </Container>
    </>
  );
};
export default ProductList;
