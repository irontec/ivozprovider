import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
  EntityValidator,
  EntityValidatorResponse,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  ApplicationServerSetProperties,
  ApplicationServerSetPropertyList,
} from './ApplicationServerSetProperties';

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, entityService, row } = props;
  const isDeletePath =
    isEntityItem(routeMapItem) &&
    routeMapItem.route === `${ApplicationServerSet.path}/:id`;

  const isDefaultApplicationServerSet = row.id === 0;

  if (isDeletePath && isDefaultApplicationServerSet) {
    return (
      <DeleteRowButton
        disabled={true}
        row={row}
        entityService={entityService}
      />
    );
  }

  return DefaultChildDecorator(props);
};

const properties: ApplicationServerSetProperties = {
  name: {
    label: _('Name'),
  },
  distributeMethod: {
    label: _('Distribute Method'),
    default: 'hash',
    enum: {
      rr: _('Round robin'),
      hash: _('Hash'),
    },
  },
  description: {
    label: _('Description'),
  },
  applicationServers: {
    label: _('Application Server', { count: 2 }),
    type: 'array',
    $ref: '#/definitions/ApplicationServer',
  },
};

const validator: EntityValidator = (values, properties, visualToggle) => {
  const response: EntityValidatorResponse = defaultEntityBehavior.validator(
    values,
    properties,
    visualToggle
  );

  const emptyApplicationServers = Array.isArray(values.applicationServers)
    ? values.applicationServers.length === 0
    : true;

  if (emptyApplicationServers) {
    response['applicationServers'] = _('Application servers cannot be empty');
  }

  return response;
};

const ApplicationServerSet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  link: '/doc/${language}/administration_portal/platform/infrastructure/application_server_sets.html',
  iden: 'ApplicationServerSet',
  title: _('Application Server Set', { count: 2 }),
  path: '/application_server_sets',
  toStr: (row: ApplicationServerSetPropertyList<EntityValue>) =>
    String(row.name),
  properties,
  validator,
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default ApplicationServerSet;
