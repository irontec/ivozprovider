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
import MilitaryTechIcon from '@mui/icons-material/MilitaryTech';

import {
  SpecialNumberProperties,
  SpecialNumberPropertyList,
} from './SpecialNumberProperties';

const properties: SpecialNumberProperties = {
  number: {
    label: _('Number'),
    pattern: new RegExp(`^[0-9]+$`),
  },
  disableCDR: {
    label: _('Disable CDR'),
    default: '1',
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(`Mark yes to hide this destination calls in all lists`),
  },
  country: {
    label: _('Country', { count: 1 }),
  },
  global: {
    label: _('Global'),
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row, entityService } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === SpecialNumber.iden
  ) {
    const isUpdatePath =
      routeMapItem.route === `${SpecialNumber.path}/:id/update`;
    const isDeletePath = routeMapItem.route === `${SpecialNumber.path}/:id`;
    const isRestricted = row.global;

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

const SpecialNumber: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MilitaryTechIcon,
  link: '/doc/en/administration_portal/brand/settings/special_numbers.html',
  iden: 'SpecialNumber',
  title: _('Special Number', { count: 2 }),
  path: '/special_numbers',
  toStr: (row: SpecialNumberPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['country', 'number', 'disableCDR'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'SpecialNumbers',
  },
  ChildDecorator,
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
};

export default SpecialNumber;
