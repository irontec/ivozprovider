import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'maxMembers', 'announceUserCount'],
    },
    {
      legend: _('Authentication Settings'),
      fields: ['pinProtected', 'pinCode'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
