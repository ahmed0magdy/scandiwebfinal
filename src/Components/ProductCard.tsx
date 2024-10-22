import { Card, Form } from "react-bootstrap";
import { Product } from "../services/types";

interface ProductCardProps {
  product: Product;
  isSelected: boolean;
  onCheckboxChange: (id: string) => void;
  formattedAttributes: string;
}

const ProductCard = ({
  product,
  isSelected,
  onCheckboxChange,
  formattedAttributes,
}: ProductCardProps) => {
  const { id, sku, name, price } = product;

  return (
    <Card className="pb-4 border shadow">
      <Card.Body className="d-flex flex-column">
        <Form.Check
          type="checkbox"
          id={id}
          className="delete-checkbox mb-3"
          checked={isSelected}
          onChange={() => onCheckboxChange(id)}
        />
        <div className="text-center">
          <Card.Title>{sku}</Card.Title>
          <Card.Subtitle>{name}</Card.Subtitle>
          <Card.Text>{price} $</Card.Text>
          <Card.Text>{formattedAttributes}</Card.Text>
        </div>
      </Card.Body>
    </Card>
  );
};

export default ProductCard;
