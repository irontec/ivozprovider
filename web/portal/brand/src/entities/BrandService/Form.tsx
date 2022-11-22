import { PropertyList } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties } = props;
  const edit = props.edit || false;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  if (edit) {
    const newProperties = { ...properties };
    newProperties.service = {
      ...newProperties.service,
      readOnly: true,
    };

    entityService.replaceProperties(newProperties as PropertyList);
  }

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['service'],
    },
    {
      legend: '',
      fields: ['code'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
