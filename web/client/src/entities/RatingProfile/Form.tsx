import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService } = props;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices(foreignKeyGetter, entityService);

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} />);
}

export default Form;