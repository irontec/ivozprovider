import _ from 'services/Translations/translate';

interface LastExecutionProps {
    type: string,
    recorder: string
}

const TypeGhost = (props: LastExecutionProps) => {

    const type = _(props.type);
    const recorder = props.recorder;

    const response = recorder
        ? (<span>{type} ({recorder})</span>)
        : type;

    return (<span>{response}</span>);
}

export default TypeGhost;