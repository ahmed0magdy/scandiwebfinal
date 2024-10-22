import { ProductAttribute } from "../services/types";

type StringAttributeFormatter = (value: string) => string;
type ArrayAttributeFormatter = (values: string[]) => string;

const sizeFormatter = (value: string): string => `Size: ${value} MB`;
const weightFormatter = (value: string): string => `Weight: ${value} Kg`;
const dimensionsFormatter = ([height, width, length]: string[]): string => {
  return `Dimensions: ${height} x ${width} x ${length}`;
};

const stringFormatters: { [key: string]: StringAttributeFormatter } = {
  Size: sizeFormatter,
  Weight: weightFormatter,
};
const arrayFormatters: { [key: string]: ArrayAttributeFormatter } = {
  Dimensions: dimensionsFormatter,
};

export const getFormattedAttributes = (
  attributes: ProductAttribute[]
): string => {
  const formattedAttributes: string[] = [];
  const dimensions: Record<string, string> = {
    height: "",
    width: "",
    length: "",
  };

  attributes.forEach(({ attribute, value }) => {
    const furnitureAttribute = attribute.name.toLowerCase();
    if (furnitureAttribute in dimensions) {
      dimensions[furnitureAttribute] = value;
    } else {
      const formatter = stringFormatters[attribute.name];
      if (formatter) {
        formattedAttributes.push(formatter(value));
      }
    }
  });

  if (dimensions.height && dimensions.width && dimensions.length) {
    const formatter = arrayFormatters["Dimensions"];
    if (formatter) {
      formattedAttributes.push(
        formatter([dimensions.height, dimensions.width, dimensions.length])
      );
    }
  }

  return formattedAttributes.join(", ");
};
