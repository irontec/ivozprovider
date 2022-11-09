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

const TaxRate: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { taxRate } = values;

  const value = `${taxRate} %`;

  return <span>{value}</span>;
};

export default withCustomComponentWrapper<InvoiceValues>(TaxRate);
