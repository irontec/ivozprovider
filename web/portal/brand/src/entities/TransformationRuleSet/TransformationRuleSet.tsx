import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { TransformationRuleSetProperties } from './TransformationRuleSetProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: TransformationRuleSetProperties = {
  description: {
    label: _('Description'),
    maxLength: 250,
  },
  internationalCode: {
    label: _('International Code'),
    pattern: new RegExp(`^[0-9]{2,10}$`),
    maxLength: 5,
    default: '00',
    helpText: _(`Code used for internationals calls, usually 00.`),
  },
  trunkPrefix: {
    label: _('Trunk Prefix'),
    pattern: new RegExp(`^[0-9]+$`),
    maxLength: 5,
    helpText: _(`Prefix used for national out of area calls.`),
  },
  areaCode: {
    label: _('Area code'),
    maxLength: 10,
    helpText: _('Calling a number within the same Area can omit Area Code'),
  },
  nationalLen: {
    label: _('National Len'),
    default: 9,
    helpText: _(
      `How long are the normal phone numbers called inside this country?`
    ),
  },
  generateRules: {
    label: _('Generate Transformation Rules automatically'),
    helpText: _('Mark this option to regenerate all rules after saving.'),
  },
  name: {
    label: _('Name'),
    maxLength: 100,
  },
  country: {
    label: _('Country code'),
    default: 70,
  },
};

const TransformationRuleSet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'TransformationRuleSet',
  title: _('TransformationRuleSet', { count: 2 }),
  path: '/TransformationRuleSets',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default TransformationRuleSet;
