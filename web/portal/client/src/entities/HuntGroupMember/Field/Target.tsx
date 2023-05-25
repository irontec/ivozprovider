import { EntityValues } from '@irontec/ivoz-ui';
import withCustomComponentWrapper, {
  CustomFunctionComponentContext,
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { CountryPropertyList } from '../../Country/CountryProperties';
import User from '../../User/User';
import { HuntGroupMemberPropertyList } from '../HuntGroupMemberProperties';

type CountryProperty = CountryPropertyList<string>;

type HuntGroupMemberValues = HuntGroupMemberPropertyList<
  string | number | CountryProperty
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<HuntGroupMemberValues>
>;

const Type: TargetGhostType = (props): JSX.Element | null => {
  const { _context, choices } = props;
  let { values } = props;

  if (_context === CustomFunctionComponentContext.write) {
    if (!choices) {
      return null;
    }

    values = {
      ...values,
      ...choices,
    };
  }

  if (values.routeType === 'user') {
    return <span>{User.toStr(values.user as EntityValues)}</span>;
  }

  const { numberCountry, numberValue } = values;

  return (
    <span>
      {`${(numberCountry as CountryProperty).countryCode} ${numberValue}`}
    </span>
  );
};

export default withCustomComponentWrapper<HuntGroupMemberValues>(Type);
