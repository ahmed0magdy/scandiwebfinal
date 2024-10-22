const getAttributeDescription = (attrName: string) => {
  switch (attrName.toLowerCase()) {
    case "size":
      return "Please, provide size (MB)";
    case "weight":
      return "Please, provide weight (Kg)";
    case "length":
      return "Please, provide dimensions (HxWxL)";
    default:
      return "";
  }
};

export default getAttributeDescription;
