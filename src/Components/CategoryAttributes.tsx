import { Form, Row, Col } from "react-bootstrap";
import { AttributeInput, Category } from "../services/types";
import getAttributeDescription from "../helpers/attributeDiscription";

interface CategoryAttributesProps {
  category?: Category;
  selectedProductAttributes: AttributeInput[];
  onAttributeChange: (id: string, value: string) => void;
}

const CategoryAttributes = ({
  category,
  selectedProductAttributes,
  onAttributeChange,
}: CategoryAttributesProps) => {
  return (
    <>
      {category?.attributes.map((attr) => (
        <Form.Group as={Row} key={attr.id} className="mb-3">
          <Form.Label htmlFor={attr.name.toLowerCase()} column sm={3}>
            {attr.name} (
            {attr.name === "size" ? "MB" : attr.name === "weight" ? "Kg" : "cm"}
            )
          </Form.Label>
          <Col sm={9}>
            <Form.Control
              type="text"
              id={attr.name.toLowerCase()}
              value={
                selectedProductAttributes.find((a) => a.id === attr.id)
                  ?.value || ""
              }
              onChange={(e) => onAttributeChange(attr.id, e.target.value)}
              required
            />
            <Form.Text>{getAttributeDescription(attr.name)}</Form.Text>
          </Col>
        </Form.Group>
      ))}
    </>
  );
};
export default CategoryAttributes;
