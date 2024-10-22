import React, { useState } from "react";
import { Form, Row, Col } from "react-bootstrap";
import { Category } from "../services/types";

interface CategorySelectorProps {
  categories?: Category[];
  onCategoryChange?: (categoryId: string) => void;
}

const CategorySelector: React.FC<CategorySelectorProps> = ({
  categories,
  onCategoryChange,
}) => {
  const [selectedCategory, setSelectedCategory] = useState<string>("");

  const handleCategoryChange = (
    event: React.ChangeEvent<HTMLSelectElement>
  ) => {
    const newCategory = event.target.value;
    setSelectedCategory(newCategory);
    if (onCategoryChange) {
      onCategoryChange(newCategory);
    }
  };
  return (
    <Form.Group as={Row} className="mb-3">
      <Form.Label htmlFor="productType" column sm={3}>
        Category
      </Form.Label>
      <Col sm={9}>
        <Form.Select
          id="productType"
          value={selectedCategory}
          onChange={handleCategoryChange}
          required
        >
          <option disabled value="">
            Select a category
          </option>
          {categories?.map((category) => (
            <option key={category.id} value={category.id}>
              {category.name}
            </option>
          ))}
        </Form.Select>
      </Col>
    </Form.Group>
  );
};

export default CategorySelector;
