import ContactPhoneIcon from '@mui/icons-material/ContactPhone';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { isEntityItem } from '@irontec/ivoz-ui';
import Form from './Form';
import { ContactProperties } from './ContactProperties';

const properties: ContactProperties = {
  name: {
    label: _('Name'),
  },
  lastname: {
    label: _('Lastname'),
  },
  email: {
    label: _('Email'),
  },
  workPhoneCountry: {
    label: _('Country'),
  },
  workPhone: {
    label: _('Work Phone'),
  },
  workPhoneE164: {
    label: _('Work Phone'),
  },
  mobilePhoneCountry: {
    label: _('Country'),
  },
  mobilePhone: {
    label: _('Mobile Phone'),
  },
  mobilePhoneE164: {
    label: _('Mobile Phone'),
  },
  otherPhone: {
    label: _('Other Phone'),
  },
  user: {
    label: _('User'),
  },
};

const columns = [
  'name',
  'lastname',
  'email',
  'workPhoneE164',
  'mobilePhoneE164',
  'otherPhone',
];

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (isEntityItem(routeMapItem) && routeMapItem.entity.iden === Contact.iden) {
    const isDeletePath = routeMapItem.route === `${Contact.path}/:id`;
    const allowDelete = row.user === null;
    if (isDeletePath && !allowDelete) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const Contact: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ContactPhoneIcon,
  iden: 'Contact',
  title: _('Contact', { count: 2 }),
  path: '/contacts',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Contacts',
  },
  toStr: (row: EntityValues) => (row.name as string) || '',
  properties,
  columns,
  Form,
  ChildDecorator,
};

export default Contact;
