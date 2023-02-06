import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Number data'),
      fields: ['country', 'number'],
    },
    {
      legend: '',
      fields: ['disableCDR'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
