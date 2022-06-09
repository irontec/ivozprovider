import { ListDecorator, ScalarProperty } from "@irontec/ivoz-ui";
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from "@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper";
import { QueuePropertyList } from "../QueueProperties";

type StrategyValues = QueuePropertyList<string>;
type StrategyProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<StrategyValues>
>;

const Strategy: StrategyProps = (props): JSX.Element | null => {
  const { _context, _columnName, property, values, formFieldFactory } = props;

  if (_context === "read" || !formFieldFactory) {
    return (
      <ListDecorator
        field={_columnName}
        row={values}
        property={property}
        ignoreCustomComponent={true}
      />
    );
  }

  const { choices, readOnly } = props;

  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;

  if (!values.id) {
    return formFieldFactory.getInputField(
      _columnName,
      modifiedProperty,
      choices,
      readOnly
    );
  }

  if (values?.strategy !== "linear") {
    // Cannot assign linear if it wasn't already
    const enumOptions = { ...modifiedProperty.enum };
    delete enumOptions.linear;
    modifiedProperty.enum = enumOptions;
  }

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default Strategy;
