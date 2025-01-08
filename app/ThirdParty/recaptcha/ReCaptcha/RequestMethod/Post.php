<?php
/**
 * This is a PHP library that handles calling reCAPTCHA.
 *
 * @copyright Copyright (c) 2015, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace ReCaptcha\RequestMethod;

use ReCaptcha\RequestMethod;
use ReCaptcha\RequestParameters;

/**
 * Sends POST requests to the reCAPTCHA service.
 */
class Post implements RequestMethod
{
    /**
     * URL to which requests are POSTed.
     * @const string
     */
    const SITE_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Submit the POST request with the specified parameters.
     *
     * @param RequestParameters $params Request parameters
     * @return string Body of the reCAPTCHA response
     */
    public function submit(RequestParameters $params)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, self::SITE_VERIFY_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Zwraca wynik jako string
    curl_setopt($ch, CURLOPT_POST, true); // Włącza metodę POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params->toQueryString()); // Ustawia dane POST
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Weryfikacja certyfikatów SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // Weryfikacja hosta SSL (2 oznacza pełną weryfikację)

    // Opcjonalne: ustawienie timeout
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        throw new \Exception('cURL error: ' . curl_error($ch));
    }

    curl_close($ch);

    return $response;
}
}
