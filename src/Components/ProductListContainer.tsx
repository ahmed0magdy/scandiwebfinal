import { Row, Col } from "react-bootstrap";
import { Product, ProductAttribute } from "../services/types";
import ProductCard from "./ProductCard";

interface ProductListContainerProps {
  products: Product[];
  selectedProducts: string[];
  onCheckboxChange: (id: string) => void;
  getFormattedAttributes: (attributes: ProductAttribute[]) => string;
}

const ProductListContainer = ({
  products,
  selectedProducts,
  onCheckboxChange,
  getFormattedAttributes,
}: ProductListContainerProps) => (
  <Row>
    {products.map((product) => (
      <Col key={product.id} md={4} className="mb-4">
        <ProductCard
          product={product}
          isSelected={selectedProducts.includes(product.id)}
          onCheckboxChange={onCheckboxChange}
          formattedAttributes={getFormattedAttributes(
            product.productAttributes
          )}
        />
      </Col>
    ))}
  </Row>
);

export default ProductListContainer;
