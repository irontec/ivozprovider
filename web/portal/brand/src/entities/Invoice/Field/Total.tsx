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

const Total: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  let { total } = values;
  const { currency } = values;

  total ??= 0;

  const value = `${parseFloat(total).toFixed(2)} ${currency}`;

  return <span>{value}</span>;
};

export default withCustomComponentWrapper<InvoiceValues>(Total);
