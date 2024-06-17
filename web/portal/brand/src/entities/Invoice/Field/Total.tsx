import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec-voip/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { InvoicePropertyList } from '../InvoiceProperties';

type InvoiceValues = InvoicePropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<InvoiceValues>
>;

const Total: TargetGhostType = (props): JSX.Element => {
  const { values, formFieldFactory, _context, _columnName, property } = props;
  let { total } = values;
  const { currency } = values;

  total = total || 0;

  const value = `${parseFloat(total).toFixed(2)} ${currency}`;

  if (_context === 'read' || !formFieldFactory) {
    return <span>{value}</span>;
  }

  const { choices, readOnly } = props;

  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;
  modifiedProperty.suffix = currency;

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default Total;
