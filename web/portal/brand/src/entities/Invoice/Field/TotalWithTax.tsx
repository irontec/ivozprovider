import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { InvoicePropertyList } from '../InvoiceProperties';

type InvoiceValues = InvoicePropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<InvoiceValues>
>;

const TotalWithTax: TargetGhostType = (props): JSX.Element => {
  const { values, formFieldFactory, _context, _columnName, property } = props;
  let { totalWithTax } = values;
  const { currency } = values;

  totalWithTax = totalWithTax || 0;

  const value = `${parseFloat(totalWithTax).toFixed(2)} ${currency}`;

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

export default TotalWithTax;
