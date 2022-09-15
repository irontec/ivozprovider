import { ListDecorator } from '@irontec/ivoz-ui';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { OutgoingRoutingPropertyList } from '../OutgoingRoutingProperties';

type DestinationValues = OutgoingRoutingPropertyList<string>;
type DestinationProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<DestinationValues>
>;

const Operator: DestinationProps = (props): JSX.Element | null => {
  const { _columnName, property, values } = props;
  const { routingMode } = values;

  if (routingMode === 'block') {
    return _('No carriers');
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

export default Operator;
