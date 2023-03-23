import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
const Form = (props: EntityFormProps): JSX.Element => {
  const { row } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const readOnlyProperties = {
    name: row?.id === 1,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'ip'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      readOnlyProperties={readOnlyProperties}
      groups={groups}
    />
  );
};

export default Form;
