import { CreateCSSProperties, styled } from "@mui/styles";

const sharedStyles: CreateCSSProperties = {
  fontWeight: "bold",
  lineHeight: "20px",
  verticalAlign: "middle",
  paddingRight: "5px",
};

export const StyledLastExecutionErrorMsg = styled("span")(() => {
  return {
    ...sharedStyles,
    color: "red",
  };
});

export const StyledLastExecutionSuccessMsg = styled("span")(() => {
  return {
    ...sharedStyles,
    color: "green",
  };
});
