import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import EditRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/EditRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MoveDownIcon from '@mui/icons-material/MoveDown';
import { useStoreState } from 'store';

import {
  TransformationRuleProperties,
  TransformationRulePropertyList,
} from './TransformationRuleProperties';

const properties: TransformationRuleProperties = {
  type: {
    label: _('Type'),
    enum: {
      callerin: _('Caller In'),
      calleein: _('Callee In'),
      callerout: _('Caller Out'),
      calleeout: _('Callee Out'),
    },
  },
  description: {
    label: _('Description'),
    maxLength: 64,
  },
  priority: {
    label: _('Priority'),
    required: true,
  },
  matchExpr: {
    label: _('Match Expr'),
    maxLength: 64,
    required: true,
  },
  replaceExpr: {
    label: _('Replace expr'),
    maxLength: 64,
    required: true,
  },
  transformationRuleSet: {
    label: _('Numeric transformation', { count: 1 }),
    required: true,
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row, entityService } = props;
  const parent = useStoreState((state) => state.list.parentRow);
  const isRestricted = parent?.editable === false;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === TransformationRule.iden
  ) {
    const isUpdatePath =
      routeMapItem.route === `${TransformationRule.path}/:id/update`;
    const isDeletePath =
      routeMapItem.route === `${TransformationRule.path}/:id`;

    if (isRestricted && isUpdatePath) {
      return (
        <EditRowButton
          row={row}
          disabled={true}
          path={routeMapItem.route ?? ''}
        />
      );
    }

    if (isRestricted && isDeletePath) {
      return (
        <DeleteRowButton
          row={row}
          entityService={entityService}
          disabled={true}
        />
      );
    }
  }

  return DefaultChildDecorator(props);
};

const TransformationRule: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MoveDownIcon,
  iden: 'TransformationRule',
  title: _('TransformationRule', { count: 2 }),
  path: '/transformation_rules',
  toStr: (row: TransformationRulePropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['description', 'priority', 'matchExpr', 'replaceExpr'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'TransformationRules',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  ChildDecorator,
};

export default TransformationRule;
