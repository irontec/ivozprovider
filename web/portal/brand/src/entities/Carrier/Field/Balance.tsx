import { ListDecorator } from '@irontec/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { CarrierPropertyList } from '../CarrierProperties';

type BalanceValues = CarrierPropertyList<string>;
type BalanceProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<BalanceValues>
>;

const Balance: BalanceProps = (props): JSX.Element | null => {
  const { _columnName, property, values } = props;
  const { calculateCost } = values;

  if (!calculateCost) {
    values.balance = 'Disabled';
  }

  return (
    <ListDecorator
      field={_columnName}
      row={values}
      property={property}
      ignoreCustomComponent={true}
    />
  );
};

export default Balance;
