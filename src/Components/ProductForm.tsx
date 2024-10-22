import React from "react";
import { Form, Row, Col } from "react-bootstrap";
import { ProductInput } from "../services/types";

interface ProductFormProps {
  product: ProductInput;
  onInputChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

const ProductForm: React.FC<ProductFormProps> = ({
  product,
  onInputChange,
}) => (
  <>
    <Form.Group as={Row} className="mb-3">
      <Form.Label htmlFor="sku" column sm={3}>
        SKU
      </Form.Label>
      <Col sm={9}>
        <Form.Control
          type="text"
          id="sku"
          value={product.sku}
          onChange={onInputChange}
          required
        />
      </Col>
    </Form.Group>

    <Form.Group as={Row} className="mb-3">
      <Form.Label htmlFor="name" column sm={3}>
        Name
      </Form.Label>
      <Col sm={9}>
        <Form.Control
          type="text"
          id="name"
          value={product.name}
          onChange={onInputChange}
          required
        />
      </Col>
    </Form.Group>

    <Form.Group as={Row} className="mb-3">
      <Form.Label htmlFor="price" column sm={3}>
        Price
      </Form.Label>
      <Col sm={9}>
        <Form.Control
          type="number"
          id="price"
          value={product.price === null ? "" : product.price}
          onChange={onInputChange}
          required
        />
      </Col>
    </Form.Group>
  </>
);

export default ProductForm;
