import { ScalarProperty } from '@irontec-voip/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec-voip/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { DestinationRatePropertyList } from '../DestinationRateProperties';

type DestinationRateValues = DestinationRatePropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<DestinationRateValues>
>;

const ConnectionFee: TargetGhostType = (props): JSX.Element => {
  const { values, formFieldFactory, _context, _columnName, property } = props;
  const { connectFee, currencySymbol } = values;

  const value = `${connectFee} ${currencySymbol}`;

  if (_context === 'read' || !formFieldFactory) {
    return <span>{value}</span>;
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

export default ConnectionFee;
