import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'description'],
    },
    {
      legend: '',
      fields: ['userIds', 'survivalDevice'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
