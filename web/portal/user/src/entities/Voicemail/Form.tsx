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
      fields: ['enabled', 'name'],
    },
    {
      legend: _('Notification configuration'),
      fields: ['sendMail', 'email', 'attachSound'],
    },
    {
      legend: _('Customization'),
      fields: ['locution'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
