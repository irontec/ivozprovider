import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'description', edit && 'open'],
    },
    edit && {
      legend: _('Service Information'),
      fields: ['closeExtension', 'openExtension', 'toggleExtension'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
