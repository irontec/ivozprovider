import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { TransformationRuleProperties } from './TransformationRuleProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: TransformationRuleProperties = {
  'type': {
    label: _('Type'),
    enum: {
      'callerin' : _('Callerin'),
      'calleein' : _('Calleein'),
      'callerout' : _('Callerout'),
      'calleeout' : _('Calleeout'),
    },
  },
  'description': {
    label: _('Description'),
  },
  'priority': {
    label: _('Priority'),
  },
  'matchExpr': {
    label: _('Match Expr'),
  },
  'replaceExpr': {
    label: _('Replace Expr'),
  },
  'id': {
    label: _('Id'),
  },
  'transformationRuleSet': {
    label: _('Transformation RuleSet'),
  },
};

const TransformationRule: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'TransformationRule',
  title: _('TransformationRule', { count: 2 }),
  path: '/TransformationRules',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default TransformationRule;