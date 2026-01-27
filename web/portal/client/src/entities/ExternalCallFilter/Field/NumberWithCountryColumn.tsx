import withCustomComponentWrapper, {
  CustomFunctionComponentContext,
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { CountryPropertyList } from '../../Country/CountryProperties';
import { ExternalCallFilterPropertyList } from '../ExternalCallFilterProperties';

type CountryProperty = CountryPropertyList<string>;

type ExternalCallFilterValues = ExternalCallFilterPropertyList<
  string | number | CountryProperty
>;

type NumberWithCountryColumnType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ExternalCallFilterValues>
>;

const NumberWithCountryColumn: NumberWithCountryColumnType = (
  props
): JSX.Element | null => {
  const { _context, values } = props;

  if (_context === CustomFunctionComponentContext.read) {
    const { outOfScheduleNumberCountry, outOfScheduleNumberValue } = values;

    if (!outOfScheduleNumberCountry || !outOfScheduleNumberValue) {
      return <span></span>;
    }

    const countryCode =
      typeof outOfScheduleNumberCountry === 'object'
        ? (outOfScheduleNumberCountry as CountryProperty).countryCode
        : outOfScheduleNumberCountry;

    return <span>{`${countryCode} ${outOfScheduleNumberValue}`}</span>;
  }

  return null;
};

export default withCustomComponentWrapper<ExternalCallFilterValues>(
  NumberWithCountryColumn
);
