<?php

namespace Techgrid\HashIdBundle\Controller;

use Techgrid\HashIdBundle\Annotation\Hash;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route('/hash-id/demo')
 */
class DemoController extends AbstractController
{
    /**
     * @Route("/encode", requirements={"id"="\d+"})
     *
     * @param int $id
     */
    public function encode($id): Response
    {
        $other = 30;
        $url1 = $this->generateUrl('techgrid_hash_id_demo_decode', ['id' => $id, 'other' => $other]);
        $url2 = $this->generateUrl('techgrid_hash_id_demo_decode_more', ['id' => $id, 'other' => $other]);

        $response = <<<EOT
            <html>
                <body>
                Provided id: $id, other: $other <br />
                Url with encoded parameter: <a href="$url1">$url1</a><br />
                Another url with encoded more parameters: <a href="$url2">$url2</a><br />
                </body>
            </html>
EOT;

        return new Response($response);
    }

    /**
     * @Route("/decode/{id}/{other}")
     * @Hash("id")
     */
    public function decode(Request $request, int $id, int $other): Response
    {
        return new Response($this->getDecodeResponse($request, $id, $other));
    }

    /**
     * @Route("/decode_more/{id}/{other}")
     * @Hash({"id", "other"})
     */
    public function decodeMore(Request $request, int $id, int $other): Response
    {
        return new Response($this->getDecodeResponse($request, $id, $other));
    }

    /**
     * @Hash("id")
     *
     * @param int $id
     */
    public function encodeLocalized($id): Response
    {
        $url1 = $this->generateUrl('techgrid_hash_id_demo_encode_localized', ['id' => $id, '_locale' => 'pl']);
        $url2 = $this->generateUrl('techgrid_hash_id_demo_encode_localized', ['id' => $id]);

        $response = <<<EOT
            <html>
                <body>
                Provided id: $id<br />
                Localized url with encoded parameter and locale provided: <a href="$url1">$url1</a><br />
                Localized url with encoded parameter: <a href="$url2">$url2</a><br />
                </body>
            </html>
EOT;

        return new Response($response);
    }

    private function getDecodeResponse(Request $request, int $id, int $other): string
    {
        $providedId = $this->getRouteParam($request, 'id');
        $providedOther = $this->getRouteParam($request, 'other');

        $response = <<<EOT
            <html>
                <body>
                Provided id: <b>$providedId</b>, other: <b>$providedOther</b><br />
                Decoded id: <b>$id</b>, other: <b>$other</b><br />
                </body>
            </html>
EOT;

        return $response;
    }

    private function getRouteParam(Request $request, $param)
    {
        return $request->attributes->get('_route_params')[$param];
    }
}
