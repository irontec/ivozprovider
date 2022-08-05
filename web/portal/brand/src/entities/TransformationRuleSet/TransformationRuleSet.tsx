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
  'description': {
    label: _('Description'),
  },
  'internationalCode': {
    label: _('International Code'),
  },
  'trunkPrefix': {
    label: _('Trunk Prefix'),
  },
  'areaCode': {
    label: _('Area Code'),
  },
  'nationalLen': {
    label: _('National Len'),
  },
  'generateRules': {
    label: _('Generate Rules'),
  },
  'id': {
    label: _('Id'),
  },
  'name': {
    label: _('Name'),
  },
  'country': {
    label: _('Country'),
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default TransformationRuleSet;