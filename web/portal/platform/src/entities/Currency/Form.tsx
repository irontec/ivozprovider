import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'iden',
        'symbol',
        'name',
      ],
    },
  ];

  return (
        <DefaultEntityForm {...props} groups={groups} />
  );
};

export default Form;
