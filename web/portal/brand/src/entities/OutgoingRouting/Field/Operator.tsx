import { ListDecorator, ScalarProperty } from '@irontec/ivoz-ui';
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
  const { _context, _columnName, property, values, formFieldFactory } = props;
  const { routingMode } = values;

  if (_context === 'read' || !formFieldFactory) {
    if (routingMode === 'block') {
      return _('No carriers');
    }

    if (routingMode === 'lcr') {
      return (
        <ListDecorator
          field={'carrierIds'}
          row={values}
          property={{
            ...property,
            type: 'array',
          }}
          ignoreCustomComponent={true}
        />
      );
    }

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

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default Operator;
