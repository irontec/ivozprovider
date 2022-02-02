import { match } from 'react-router-dom';

const buildLink = (link: string, match: match, id?: string): string => {

  const params = match.params as Record<string, string>
  for (const idx in params) {
    link = link.replace(
        `:${idx}`,
        params[idx]
      )
  }

  const urlParamNum = Object.values(params).length;
  if (id) {
    link = link.replace(`:parent_id_${urlParamNum + 1}`, id);
  }

  return link;
}

export default buildLink;