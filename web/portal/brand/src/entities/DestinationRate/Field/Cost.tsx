import { ScalarProperty } from '@irontec/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { DestinationRatePropertyList } from '../DestinationRateProperties';

type CalendarPeriodValues = DestinationRatePropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<CalendarPeriodValues>
>;

const Cost: TargetGhostType = (props): JSX.Element => {
  const { values, formFieldFactory, _context, _columnName, property } = props;
  const { cost, currencySymbol } = values;

  const value = `${cost} ${currencySymbol}`;

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

export default Cost;
