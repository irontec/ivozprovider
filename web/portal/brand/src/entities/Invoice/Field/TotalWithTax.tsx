import withCustomComponentWrapper, {
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
  const { values } = props;
  let { totalWithTax } = values;
  const { currency } = values;

  totalWithTax ??= 0;

  const value = `${parseFloat(totalWithTax).toFixed(2)} ${currency}`;

  return <span>{value}</span>;
};

export default withCustomComponentWrapper<InvoiceValues>(TotalWithTax);
